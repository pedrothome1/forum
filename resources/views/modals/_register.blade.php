<register-view inline-template>
    <modal name="register" height="auto">
        <div class="p-5">
            <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
                <div class="form-group">
                    <label for="name" class="text-xs text-secondary text-uppercase font-weight-600">Nome completo</label>

                    <input type="text"
                           id="name"
                           class="form-control rounded-0"
                           :class="{ 'is-invalid': form.errors.has('name') }"
                           name="name"
                           v-model="form.name"
                           autofocus>

                    <span v-show="form.errors.has('name')" class="invalid-feedback">
                        <strong class="text-danger" v-text="form.errors.get('name')"></strong>
                    </span>
                </div>

                <div class="form-group">
                    <label for="username" class="text-xs text-secondary text-uppercase font-weight-600">Nome de usuário</label>

                    <input type="text"
                           id="username"
                           class="form-control rounded-0"
                           :class="{ 'is-invalid': form.errors.has('username') }"
                           name="username"
                           v-model="form.username">

                    <span v-show="form.errors.has('username')" class="invalid-feedback">
                        <strong class="text-danger" v-text="form.errors.get('username')"></strong>
                    </span>
                </div>

                <div class="form-group">
                    <label for="email" class="text-xs text-secondary text-uppercase font-weight-600">E-mail</label>

                    <input type="email"
                           id="email"
                           class="form-control rounded-0"
                           :class="{ 'is-invalid': form.errors.has('email') }"
                           name="email"
                           v-model="form.email">

                    <span v-show="form.errors.has('email')" class="invalid-feedback">
                        <strong class="text-danger" v-text="form.errors.get('email')"></strong>
                    </span>
                </div>

                <div class="form-group">
                    <label for="password" class="text-xs text-secondary text-uppercase font-weight-600">Senha</label>

                    <input type="password"
                           id="password"
                           class="form-control rounded-0"
                           :class="{ 'is-invalid': form.errors.has('password') }"
                           name="password"
                           v-model="form.password">

                    <span v-show="form.errors.has('password')" class="invalid-feedback">
                        <strong class="text-danger" v-text="form.errors.get('password')"></strong>
                    </span>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="text-xs text-secondary text-uppercase font-weight-600">Confirme a senha</label>

                    <input type="password"
                           id="password_confirmation"
                           class="form-control rounded-0"
                           name="password_confirmation"
                           v-model="form.password_confirmation">
                </div>

                <div class="form-group d-flex justify-content-between align-items-center mb-0">
                    <button type="submit" class="btn btn-success btn-bright-success">Cadastrar-se</button>

                    <a @click.prevent="login" href="#" class="text-muted">Já possui conta?</a>
                </div>
            </form>
        </div>
    </modal>
</register-view>
