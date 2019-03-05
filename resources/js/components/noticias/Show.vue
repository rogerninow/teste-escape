<template>
    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <div class="input-group col-12 pb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Procurar..." @keyup.enter="getNoticias"
                        aria-label="procurar" aria-describedby="basic-addon1"  v-model.trim="filters.search">
                </div>
            </div>
            <div class="row">
                <div class="card col-4" style="cursor: pointer;" v-for="noticia in noticias" @click="ver(noticia.id)">
                    <img :src="noticia.url_foto" v-holder="'img=100px200?auto=yes&theme=social&text='+noticia.titulo+''" :alt="noticia.titulo">
                    <p class="card-text">
                        {{noticia.texto.slice(0, 150)}}...
                        <button class="btn btn-secundary btn-sm text-muted float-right">Ler mais</button>
                    </p>
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
                modalVer: false,
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
        }
    }
</script>
