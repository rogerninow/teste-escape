<template>
    <div class="modal fade" id="editarCategoria" role="dialog">
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
                        <button type="button" class="btn btn-warning btn-sm text-white" @click="alterar" :disabled="submiting">Alterar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['categoriaId'],
        data() {
            return {
                loading: true,
                loadingCat: true,
                submiting: false,
                categoria: [],
                options: {
                    categorias: []
                },
                errors: {},
            }
        },
        mounted() {
            this.getCategorias();
            this.getNoticia();
        },
        methods: {
            getNoticia() {
                this.loading = true;
                axios.get(`/api/categorias/${this.categoriaId}`)
                    .then(response => { this.categoria = response.data;})
                    .catch(error => {
                        this.$toasted.error('Esta notícia não existe!', {
                                action : {
                                    text : 'X',
                                    onClick : (e, toastObject) => {toastObject.goAway(0);}
                                }
                            }
                        );
                        location.href = '/categorias';
                    })
                    .then(() => { this.loading = false; })
            },
            getCategorias() {
                this.loadingCat = true;
                axios.post(`/api/categorias/filter`)
                    .then(response => { 
                        response.data.forEach((categoria) => {
                            this.options.categorias.push(categoria.nome);
                        });
                    })
                    .catch(error => {
                        this.$toasted.error('Nenhuma categoria encontrada!', {
                                action : {
                                    text : 'X',
                                    onClick : (e, toastObject) => {toastObject.goAway(0);}
                                }
                            }
                        );
                    })
                    .then(() => { this.loadingCat = false; })
            },
            alterar(id) {
                if (!this.submiting) {
                    this.submiting = true;
                    axios.put(`/api/categorias/update/${this.categoriaId}`, this.categoria)
                        .then(response => {
                            this.$toasted.success('Categoria alterada!');
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
                        .then(() => { this.submiting = false; console.log(this.promocao) });
                }
            },
            close() {
                this.$emit('close');
            }
        }
    }
</script>
