<login-view inline-template>
    <modal name="login" height="auto">
        <div class="p-5">
            <form @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
                <div class="form-group">
                    <label for="email" class="text-xs text-secondary text-uppercase font-weight-600">E-mail</label>

                    <input type="email"
                           id="email"
                           class="form-control rounded-0"
                           :class="{ 'is-invalid': form.errors.has('email') }"
                           name="email"
                           v-model="form.email"
                           autofocus>

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

                <div class="form-group d-flex justify-content-between align-items-center mb-0">
                    <button type="submit" class="btn btn-success btn-bright-success">Entrar</button>

                    <a href="#" class="text-muted">Esqueceu a senha?</a>
                </div>
            </form>
        </div>
    </modal>
</login-view>
