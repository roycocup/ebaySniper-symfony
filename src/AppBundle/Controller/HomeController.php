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

    public function getConfig(): array {
        $ebay = $this->getParameter('ebay');
        $config = [
            'apiVersion' => \DTS\eBaySDK\Shopping\Services\ShoppingService::API_VERSION,
            'credentials' => [
                'appId' => $ebay['credentials']['prod']['appId'],
                'devId' => $ebay['credentials']['prod']['devId'],
                'certId' => $ebay['credentials']['prod']['certId'],
            ],
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
            ->add('itemEbayId', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Get Item'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
             $em = $this->getDoctrine()->getManager();
             $em->persist($item);
             $em->flush();

            return $this->redirectToRoute('app_home_getitem', ['item'=>$item->getId()]);
        }

        return $this->render('index/itemSearch.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/getItem/{item}")
     */
    public function getItemAction(Item $item)
    {
        $config = $this->getConfig();

        $data = "";
        $service = new Services\ShoppingService($config);

        $request = new Types\GetSingleItemRequestType();
        $request->ItemID = $item->getItemEbayId();
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

        if ($response->Ack !== 'Failure') {
            $item = $response->Item;
            print("$item->Title\n");
            printf(
                "Quantity sold %s, quantiy available %s<br>",
                $item->QuantitySold,
                $item->Quantity - $item->QuantitySold
            );
            if (isset($item->ItemSpecifics)) {
                print("<br>This item has the following item specifics:<br><br>");
                foreach ($item->ItemSpecifics->NameValueList as $nameValues) {
                    printf(
                        "%s: %s<br>",
                        $nameValues->Name,
                        implode(', ', iterator_to_array($nameValues->Value))
                    );
                }
            }
            if (isset($item->Variations)) {
                print("<br>This item has the following variations:<br>");
                foreach ($item->Variations->Variation as $variation) {
                    printf(
                        "<br>SKU: %s<br>Start Price: %s<br>",
                        $variation->SKU,
                        $variation->StartPrice->value
                    );
                    printf(
                        "Quantity sold %s, quantiy available %s<br>",
                        $variation->SellingStatus->QuantitySold,
                        $variation->Quantity - $variation->SellingStatus->QuantitySold
                    );
                    foreach ($variation->VariationSpecifics as $specific) {
                        foreach ($specific->NameValueList as $nameValues) {
                            printf(
                                "%s: %s<br>",
                                $nameValues->Name,
                                implode(', ', iterator_to_array($nameValues->Value))
                            );
                        }
                    }
                }
            }
            if (isset($item->ItemCompatibilityCount)) {
                printf("<br>This item is compatible with %s vehicles:<br><br>", $item->ItemCompatibilityCount);
                // Only show the first 3.
                $limit = min($item->ItemCompatibilityCount, 3);
                for ($x = 0; $x < $limit; $x++) {
                    $compatibility = $item->ItemCompatibilityList->Compatibility[$x];
                    foreach ($compatibility->NameValueList as $nameValues) {
                        printf(
                            "%s: %s\n",
                            $nameValues->Name,
                            implode(', ', iterator_to_array($nameValues->Value))
                        );
                    }
                    printf("Notes: %s \n", $compatibility->CompatibilityNotes);
                }
            }
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
