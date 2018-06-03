<script>
    import Form from '../core/Form';

    export default {
        data() {
            return {
                form: new Form({
                    email: '',
                    password: ''
                }),

                isLoading: false,
            };
        },

        methods: {
            onSubmit() {
                this.isLoading = true;

                this.form.post('/login').then(data => {
                    location.assign(data.redirect);

                    this.isLoading = false;
                }).catch(errors => {
                    this.isLoading = false;
                });
            }
        }
    }
</script>
