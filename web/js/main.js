var Timer = /** @class */ (function () {
    function Timer(tl, timerElement) {
        this.tl = tl;
        this.timeLeftSecs = tl;
        this.timerElement = document.getElementById(timerElement);
    }
    Timer.prototype.start = function () {
        if (this.timeLeftSecs > 0) {
            this.timerToken = setInterval(function (t) {
                var date = new Date(null);
                date.setSeconds(this.timeLeftSecs);
                this.timerElement.innerText =
                    date.getDay() + " days " +
                        date.getHours() + " hours " +
                        date.getMinutes() + " minutes " +
                        date.getSeconds() + " seconds ";
                this.timeLeftSecs--;
            }.bind(this), 1000);
        }
    };
    Timer.prototype.stop = function () {
        clearTimeout(this.timerToken);
    };
    return Timer;
}());
