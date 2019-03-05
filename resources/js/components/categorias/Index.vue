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
                                <input type="text" class="form-control" placeholder="Procurar..." @keyup.enter="getCategoria"
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
                                    <th>Nome</th>
                                    <th>Criado em:</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in categorias">
                                    <td>{{categoria.id}}</td>
                                    <td>{{categoria.nome}}</td>
                                    <td class="d-none d-sm-table-cell">
                                        <small>{{categoria.created_at | moment("LL")}}</small>
                                        -
                                        <small class="text-muted">{{categoria.created_at | moment("LT")}}</small>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm text-white" @click="editar(categoria.id)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" :disabled="submitingDestroy" @click="remover(categoria.id)">
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

            <categorias-edit
                v-if="modalEdit"
                @close="modalEdit = false"
                :categoriaId="categoriaId"
            />

            <categorias-create
                v-if="modalNew"
                @close="modalNew = false"
            />
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categorias: [],
                 filters: {
                    search: ''
                },
                loading: true,
                submitingDestroy: false,
                modalEdit: false,
                modalNew: false,
                categoriaId: ''
            }
        },
        mounted() {
            this.getCategoria();
        },
        methods: {
            getCategoria() {
                this.categorias = [];

                axios.post(`/api/categorias/filter`, this.filters)
                    .then(response => {
                        this.categorias = response.data;
                        delete response.data.data;
                        //this.filters.pagination = response.data;
                    })
                    .catch(error => {
                        this.$toasted.error('Erro ao buscar as categorias', {
                                action : {
                                    text : 'X',
                                    onClick : (e, toastObject) => {toastObject.goAway(0);}
                                }
                            }
                        );
                    })
                    .then(() => {this.loading = false;});
            },
            editar(id) {
                this.modalEdit = true;
                this.categoriaId = id;
                setTimeout(() => {
                    $('#editarCategoria').modal('show');
                }, 100);
            },
            cadastrar() {
                this.modalNew = true;
                setTimeout(() => {
                    $('#cadastrarCategoria').modal('show');
                }, 100);
            },
            remover(id) {
                if (!this.submitingDestroy) {
                    this.submitingDestroy = true;
                    this.$swal(({
                        title: "Você tem certeza?",
                        text: "Uma vez removido, não será possivel restaurar esta categoria!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        showCancelButton: true
                    }))
                        .then((willDelete) => {
                            if (willDelete.value) {
                                axios.delete(`/api/categorias/${id}`)
                                    .then(response => {
                                        this.$toasted.success('Categoria removida!');
                                        this.filters.search = '';
                                        setTimeout(() => { location.href = '/categorias'}, 500)
                                    })
                                    .catch(error => {
                                        this.$toasted.error('Erro ao remover a categoria!');
                                    })
                            }
                            this.submitingDestroy = false;
                        })
                }
            },
        }
    }
</script>
