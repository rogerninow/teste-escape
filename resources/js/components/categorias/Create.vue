<template>
    <div class="modal fade" id="cadastrarCategoria" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Categoria <strong>#{{categoria.id}}</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" @click="close">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <label for="nome" class="col-form-label">Nome</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-font"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="nome" size="100"
                                       :class="{'is-invalid': errors.nome}" v-model="categoria.nome">
                                <div class="invalid-feedback" v-if="errors.nome">{{errors.nome[0]}}</div>
                            </div>
                        </div>
                    </div>

                    <content-placeholders v-if="loading">
                        <content-placeholders-heading :img="true" />
                        <content-placeholders-text :lines="15" />
                    </content-placeholders>

                </div>

                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" @click="close">Fechar</button>
                        <button type="button" class="btn btn-primary btn-sm text-white" @click="cadastrar" :disabled="submiting">Cadastrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading: true,
                loadingCat: true,
                submiting: false,
                categoria: {},
                errors: {}
            }
        },
        mounted() {
            this.loading = false;
        },
        methods: {
            cadastrar() {
                if (!this.submiting) {
                    this.submiting = true;
                    console.log(this.categoria);
                    axios.post(`/api/categorias/store`, this.categoria)
                        .then(response => {
                            this.$toasted.success('Categoria criada!');
                            setTimeout( () => {
                                location.href = '/categorias';
                            }, 500);
                        })
                        .catch(error => {
                            this.$toasted.error('Erro ao criar categoria!');

                            if (error.response.data.errors) {
                                this.errors = error.response.data.errors;
                            }
                        })
                        .then(() => { this.submiting = false; });
                }
            },
            close() {
                this.$emit('close');
            }
        }
    }
</script>
