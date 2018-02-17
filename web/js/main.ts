class Timer{
    private timeLeftSecs: number;
    private timerElement: HTMLElement;
    private timerToken;

    constructor(public tl: number, timerElement: string) {
        this.timeLeftSecs = tl;
        this.timerElement = document.getElementById(timerElement);
    }

    public start(){
        if (this.timeLeftSecs > 0){
            this.timerToken = setInterval(function(t){
                let date = new Date(null);
                date.setSeconds(this.timeLeftSecs);
                this.timerElement.innerText =
                    date.getDay() + " days " +
                    date.getHours() + " hours " +
                    date.getMinutes() + " minutes " +
                    date.getSeconds() + " seconds "
                ;
                this.timeLeftSecs--
            }.bind(this), 1000);
        }
    }

    public stop() {
        clearTimeout(this.timerToken);
    }

}


