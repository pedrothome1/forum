<script>
    import Form from '../core/Form';

    export default {
        data() {
            return {
                form: new Form({
                    email: '',
                    password: ''
                })
            };
        },

        methods: {
            onSubmit() {
                this.form.post('/login').then(data => {
                    location.assign(data.redirect);
                }).catch(errors => {});
            }
        }
    }
</script>
