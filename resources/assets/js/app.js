/**
 * Import the dependencies
 */
require('./bootstrap');

new Vue({
    el: '#root',

    data: {
        success: {
            display: false,
            description: '',
        },

        error: {
            display: false,
            description: 'An error occurred. Please try again.',
        },

        wait: false,

        from: Object.keys(currencies)[0],
        to: Object.keys(currencies)[1],
        amount: '',
    },

    methods: {
        calculate() {
            this.wait = true;

            axios.post('api/convert', {
                from: this.from,
                to: this.to,
                amount: this.amount,
            }, {
                headers: {
                    accept: 'application/json'
                }
            }).then((response) => {
                this.wait = false;

                this.error.display = false;

                this.success.description = response.data.result.description;
                this.success.display = true;
            }).catch((error) => {
                this.wait = false;

                this.success.display = false;
                this.error.display = true;

                this.amount = '';
            });

            document.getElementById('amount').focus();
        }
    }
});
