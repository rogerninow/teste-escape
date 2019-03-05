<template>
    <div class="album text-muted">
        <div class="container">
           <div class="row" v-if="!loading">
                <div class="card col-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="input-group col-10">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Procurar..." @keyup.enter="getNoticias"
                                    aria-label="procurar" aria-describedby="basic-addon1"  v-model.trim="filters.search">
                            </div>
                            <div class="col col-2">
                                <button class="btn btn-primary" @click="cadastrar">Novo</button>
                            </div>
                        </div>
                        <br/>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Categoria</th>
                                    <th>Criado em:</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="noticia in noticias">
                                    <td>{{noticia.id}}</td>
                                    <td>{{noticia.titulo}}</td>
                                    <td>{{noticia.categoria}}</td>
                                    <td class="d-none d-sm-table-cell">
                                        <small>{{noticia.created_at | moment("LL")}}</small>
                                        -
                                        <small class="text-muted">{{noticia.created_at | moment("LT")}}</small>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm text-white" @click="ver(noticia.id)">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm text-white" @click="editar(noticia.id)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" :disabled="submitingDestroy" @click="remover(noticia.id)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <content-placeholders v-if="loading">
                <content-placeholders-heading :img="true" />
                <content-placeholders-text :lines="30" />
            </content-placeholders>

            <noticias-ver
                v-if="modalVer"
                @close="modalVer = false"
                :noticiaId="noticiaId"
            />

            <noticias-edit
                v-if="modalEdit"
                @close="modalEdit = false"
                :noticiaId="noticiaId"
            />

            <noticias-create
                v-if="modalNew"
                @close="modalNew = false"
            />
        </div>
    </div>
</template>

<script>
    import Ver from './Ver';
    export default {
        components: {Ver},
        data() {
            return {
                noticias: [],
                 filters: {
                    search: ''
                },
                loading: true,
                submitingDestroy: false,
                modalVer: false,
                modalEdit: false,
                modalNew: false,
                noticiaId: ''
            }
        },
        mounted() {
            this.getNoticias();
        },
        methods: {
            getNoticias() {
                this.noticias = [];

                axios.post(`/api/noticias/filter`, this.filters)
                    .then(response => {
                        this.noticias = response.data;
                        delete response.data.data;
                        console.log(this.filters.search);
                        //this.filters.pagination = response.data;
                    })
                    .catch(error => {
                        this.$toasted.error('Erro ao buscar as noticias', {
                                action : {
                                    text : 'X',
                                    onClick : (e, toastObject) => {toastObject.goAway(0);}
                                }
                            }
                        );
                    })
                    .then(() => {this.loading = false;});
            },
            ver(id) {
                this.modalVer = true;
                this.noticiaId = id;
                setTimeout(() => {
                    $('#verNoticia').modal('show');
                }, 100);
            },
            editar(id) {
                this.modalEdit = true;
                this.noticiaId = id;
                setTimeout(() => {
                    $('#editarNoticia').modal('show');
                }, 100);
            },
            cadastrar() {
                this.modaNew = true;
                setTimeout(() => {
                    $('#cadastrarNoticia').modal('show');
                }, 100);
            },
            remover(id) {
                if (!this.submitingDestroy) {
                    this.submitingDestroy = true;
                    this.$swal(({
                        title: "Você tem certeza?",
                        text: "Uma vez removido, não será possivel restaurar esta notícia!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        showCancelButton: true
                    }))
                        .then((willDelete) => {
                            if (willDelete.value) {
                                axios.delete(`/api/noticias/${id}`)
                                    .then(response => {
                                        this.$toasted.success('Notícia removida!');
                                        this.filters.search = '';
                                        setTimeout(() => { location.href = '/noticias'}, 500)
                                    })
                                    .catch(error => {
                                        this.$toasted.error('Erro ao remover a notícia!');
                                    })
                            }
                            this.submitingDestroy = false;
                        })
                }
            },
        }
    }
</script>
