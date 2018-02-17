<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use \DTS\eBaySDK\Shopping\Services;
use \DTS\eBaySDK\Shopping\Types;

class HomeController extends Controller
{

    public function getConfig($envio = 'sandbox'): array {
        $ebay = $this->getParameter('ebay');

        $credentials = [];

        if ($envio == 'sandbox'){
            $credentials = [
                'appId' => $ebay['credentials']['sandbox']['appId'],
                'devId' => $ebay['credentials']['sandbox']['devId'],
                'certId' => $ebay['credentials']['sandbox']['certId'],
            ];
        }

        if ($envio == 'prod'){
            $credentials = [
                'appId' => $ebay['credentials']['prod']['appId'],
                'devId' => $ebay['credentials']['prod']['devId'],
                'certId' => $ebay['credentials']['prod']['certId'],
            ];
        }

        $config = [
            'apiVersion' => \DTS\eBaySDK\Shopping\Services\ShoppingService::API_VERSION,
            'siteId'=> '3', // 3 ebay UK, 0-US, 2-Can, 15-aus, 16-austria, 23-belgium, 71 france // http://www.ebay.com/gds/ALL-EBAY-WORLD-SITES-/10000000204201621/g.html
            'credentials' => $credentials,
        ];

        return $config;
    }

    /**
     * @Route("/")
     * https://github.com/davidtsadler/ebay-sdk-examples/blob/master/shopping/02-get-single-item.php
     */
    public function indexAction(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $item = new Item();
        $item->setCreated(new \DateTime());

        $form = $this->createFormBuilder($item)
            ->add('itemId', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Get Item'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();

            return $this->redirectToRoute('app_home_getitem', ['itemId'=>$item->getItemId()]);
        }

        return $this->render('index/itemSearch.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/getItem/{itemId}")
     */
    public function getItemAction($itemId)
    {
        $config = $this->getConfig('prod');

        $data = "";
        $em = $this->getDoctrine()->getManager();
        $service = new Services\ShoppingService($config);

        $request = new Types\GetSingleItemRequestType();
        $request->ItemID = $itemId;
        $response = $service->getSingleItem($request);

        if (isset($response->Errors)) {
            foreach ($response->Errors as $error) {
                printf(
                    "%s: %s\n%s\n\n",
                    'Error',
                    $error->ShortMessage,
                    $error->LongMessage
                );
            }
        }
        $ebayItem = $response->Item;

        if ($response->Ack !== 'Failure') {
            $exists = $em->getRepository(Item::class)->findOneByItemId($itemId);

            if (!$exists){

                $em = $this->getDoctrine()->getManager();

                $item = new Item();
                $item->setItemId($itemId);
                $item->setCountry($ebayItem->Country);
                $item->setTitle($ebayItem->Title);
                $item->setGalleryURL($ebayItem->GalleryURL);
                $item->setPrimaryCategoryName($ebayItem->PrimaryCategoryName);
                $item->setUpdated(new \DateTime());
                $item->setPrimaryCategoryName($ebayItem->PrimaryCategoryName);
                $item->setPrimaryCategoryId($ebayItem->PrimaryCategoryID);
                $item->setBidCount($ebayItem->BidCount);
                $item->setAutoPay($ebayItem->AutoPay);
                $item->setCountry($ebayItem->Country);
                $item->setListingStatus($ebayItem->ListingStatus);
                $item->setTimeLeft($ebayItem->TimeLeft);
                $item->setEndTime($ebayItem->EndTime);
                $item->setConditionName($ebayItem->ConditionDisplayName);
                $item->setCreated(new \DateTime());

                $em->persist($item);
                $em->flush();
            }

            dump($ebayItem); die;

        }

        return $this->render('default/index.html.twig', ['data' => $data]);

    }

    public function getTimeFromEbayAction(){
        $config = $this->getConfig();
        $service = new Services\ShoppingService($config);
        $request = new Types\GeteBayTimeRequestType();
        $response = $service->geteBayTime($request);


        $data = sprintf("The official eBay time is: %s\n", $response->Timestamp->format('H:i (\G\M\T) \o\n l jS Y'));


        // replace this example code with whatever you need
        // realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        return $this->render('default/index.html.twig', ['data' => $data]);
    }
}
