<script>
    import Form from '../core/Form';

    export default {
        data() {
            return {
                form: new Form({
                    name: '',
                    username: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                })
            };
        },

        methods: {
            onSubmit() {
                this.form.post('/register').then(data => {
                    location.assign(data.redirect);
                }).catch(errors => {});
            },

            login() {
                this.$modal.hide('register');
                this.$modal.show('login');
            }
        }
    }
</script>
