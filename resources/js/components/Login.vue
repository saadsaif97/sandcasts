<template>
    <!-- Login 1 -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <form class="text-center" @submit="handleSubmit">
                        <h4 class="mb-5">Sign into your account</h4>
                        <p class="text-danger" v-if="error">{{ error }}</p>
                        <div class="form-group">
                            <input
                                class="form-control"
                                type="email"
                                v-model="email"
                                placeholder="Email"
                            />
                        </div>

                        <div class="form-group">
                            <input
                                class="form-control"
                                type="password"
                                v-model="password"
                                placeholder="Password"
                            />
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input
                                    class="custom-control-input"
                                    type="checkbox"
                                    v-model="remember"
                                />
                                <label class="custom-control-label"
                                    >Remember me</label
                                >
                            </div>
                        </div>

                        <button
                            class="btn btn-lg btn-block btn-primary"
                            @click="attemptLogin"
                            :disabled="!isValidLoginForm"
                        >
                            Login
                        </button>

                        <hr />

                        <p class="small mb-0">
                            Don't have an account? <a href="#">Create one</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            email: "",
            password: "",
            remember: true,
            loading: false,
            error: ""
        };
    },
    methods: {
        emailIsValid() {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(this.email);
        },
        handleSubmit(e) {
            e.preventDefault();
        },
        attemptLogin() {
            this.loading = true;
            axios
                .post("/login", {
                    email: this.email,
                    password: this.password,
                    remember: this.remember
                })
                .then(res => {
                    console.log(res);
                    location.reload();
                })
                .catch(err => {
                    this.loading = false;
                    if (err.response.status === 422) {
                        this.error = "We could'nt verify your account details";
                    } else {
                        this.error =
                            "Something went wrong, please refresh the page and try again";
                    }
                });
        }
    },
    computed: {
        isValidLoginForm() {
            console.log(this.emailIsValid());
            return this.emailIsValid() && this.password && !this.loading;
        }
    }
};
</script>
