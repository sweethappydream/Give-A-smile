(function($) {
  class AnimatedCounter {
    /**
     * Animate numbers.
     *
     * AnimatedCounter class: .function-counter
     * data-value: counter max value
     * data-speed: speed
     */
    constructor(e = null) {
        console.log('counter class going');
        this.counters = e ? e.find('.function-counter') : $('.function-counter');
        this.intervals = [];

        // console.log(this.counters);

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
        // console.log(increment);
        if (value < maxValue) {
            counter.text(value + increment);


        } else {
            counter.text(maxValue.toLocaleString('en-US'));
            clearInterval(thisClass.intervals[counterIndex]);
        }
    }
  }

  function initializeBlock() {
    new AnimatedCounter();
  }

  $(document).ready(function() {
    initializeBlock();
  });
  if (window.acf) {
    window.acf.addAction('render_block_preview/type=counter-block', initializeBlock);
  }
})(jQuery);