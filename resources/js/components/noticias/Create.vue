<template>
    <div class="modal fade" id="cadastrarNoticia" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Cadastrar Notícia</h4>
                    <button type="button" class="close" data-dismiss="modal" @click="close">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-6">
                            <label for="nome" class="col-form-label">Nome</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-font"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="nome" size="100"
                                       :class="{'is-invalid': errors.titulo}" v-model="noticia.titulo">
                                <div class="invalid-feedback" v-if="errors.titulo">{{errors.titulo[0]}}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="nome" class="col-form-label">Categoria</label>
                            <select class="form-control" v-model="noticia.categoria_id">
                                <option :value="categoria.id" v-for="categoria in options.categorias">{{categoria.nome}}</option>
                            </select>
                            <div class="invalid-feedback" v-if="errors.categoria">{{errors.categoria[0]}}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="texto" class="col-form-label">Texto</label>
                            <textarea class="form-control" rows="20" v-model="noticia.texto" :class="{'is-invalid': errors.texto}"></textarea>
                            <div class="invalid-feedback" v-if="errors.texto">{{errors.texto[0]}}</div>
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
                noticia: {},
                options: {
                    categorias: []
                },
                errors: {},
            }
        },
        mounted() {
            this.loading = false;
            this.getCategorias();
        },
        methods: {
            getCategorias() {
                this.loadingCat = true;
                axios.post(`/api/categorias/filter`)
                    .then(response => { 
                        this.options.categorias = response.data;
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
            cadastrar() {
                if (!this.submiting) {
                    this.submiting = true;
                    axios.post(`/api/noticias/store`, this.noticia)
                        .then(response => {
                            this.$toasted.success('Notícia criada!');
                            setTimeout( () => {
                                location.href = '/noticias';
                            }, 500);
                        })
                        .catch(error => {
                            this.$toasted.error('Erro ao criar notícia!');

                            if (error.response.data.errors) {
                                this.errors = error.response.data.errors;
                            }
                        })
                        .then(() => { this.submiting = false });
                }
            },
            changeCategoria(categoria) {
                this.noticia.categoria = categoria;
            },
            close() {
                this.$emit('close');
            }
        }
    }
</script>
