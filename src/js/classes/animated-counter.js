const $ = window.jQuery;

class AnimatedCounter {
    /**
     * Animate numbers.
     *
     * AnimatedCounter class: .function-counter
     * data-value: counter max value
     * data-speed: speed
     */
    constructor(e = null) {
        this.counters = e ? e.find('.function-counter') : $('.function-counter');
        this.intervals = [];
        if (!this.counters.length) return;

        this.counters.each((i, item) => {
            const counter = $(item);
            const speed = counter.data('speed') ? parseInt(counter.data('speed')) : '300';
            const maxValue = counter.data('value') ? parseInt(counter.data('value')) : '0';
            const increment = Math.ceil(maxValue / speed);

            this.intervals[i] = setInterval(this.updateCounter, 1, this, counter, increment, maxValue, i);
        });
    }

    updateCounter(thisClass, counter, increment, maxValue, counterIndex) {
        const value = parseInt(counter.text());

        if (value < maxValue) {
            counter.text(value + increment);
        } else {
            counter.text(maxValue)
            clearInterval(thisClass.intervals[counterIndex]);
        }
    }


}

export default AnimatedCounter;