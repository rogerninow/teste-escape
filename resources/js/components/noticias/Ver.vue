<template>
    <div class="modal fade" id="verNoticia" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">{{noticia.titulo}}</h4>
                    <button type="button" class="close" data-dismiss="modal" @click="close">&times;</button>
                </div>
                <div class="modal-body">
                    
                   <div v-if="!loading">
                        <p>
                            <img :src="'storage/'+noticia.url_foto" v-holder="'img=100px200?auto=yes&theme=social&text='+noticia.titulo+''" :alt="noticia.titulo">
                        </p>

                        <p>
                            {{noticia.texto}}
                        </p>
                   </div>
                    
                    <content-placeholders v-if="loading">
                        <content-placeholders-heading :img="true" />
                        <content-placeholders-text :lines="15" />
                    </content-placeholders>

                </div>

                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" @click="close">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['noticiaId'],
        data() {
            return {
                loading: true,
                noticia: []
            }
        },
        mounted() {
            this.getNoticia();
        },
        methods: {
            getNoticia() {
                this.loading = true;
                axios.get(`/api/noticias/${this.noticiaId}`)
                    .then(response => { this.noticia = response.data;})
                    .catch(error => {
                        this.$toasted.error('Esta notícia não existe!', {
                                action : {
                                    text : 'X',
                                    onClick : (e, toastObject) => {toastObject.goAway(0);}
                                }
                            }
                        );
                        location.href = '/noticias';
                    })
                    .then(() => { this.loading = false; })
            },
            close() {
                this.$emit('close');
            }
        }
    }
</script>
