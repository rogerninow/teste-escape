<template>
   <div class="card text-center">
        <img @click="openFile" :src="image" class="card-image" v-holder="'img=100px200?auto=yes&theme=social&text=Adicionar Image'">
        <div class="card-body">
            <input hidden type="file" @change="onFileChange" class="form-control" id="inputFile">
            <button class="btn btn-danger btn-block btn-sm" v-if="image" :disabled="submiting" @click="removeLogo">
                <i class="fas fa-spinner fa-spin" v-if="submiting"></i>
                <i class="fa fa-" v-else></i>
                <span class="d-md-down-none ml-1">Remover</span>
            </button>
        </div>
    </div>
</template>
<style scoped>
    img{
        max-height: 10rem;
        max-width:  20rem;
    }
</style>
<script>
    export default {
        data(){
            return {
                image: '',
                submiting: false
            }
        },
        mounted() {
            this.image = this.imagemUrl ? 'storage/' + this.imagemUrl : '';
        },
        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);

                this.upload();
            },
            upload(){
                if (this.image && !this.submiting) {
                    this.submiting = true;
                    axios.post('/api/noticias/upload',{logo: this.image})
                        .then(response => {this.submiting = false; this.$emit('changeUrl', response.data)})
                        .catch(error => {
                            this.$toasted.error('Erro ao enviar imagem!');
                        });
                }
            },
            removeLogo() {
                if (this.imagemUrl && !this.submiting) {
                    this.submiting = true;
                    axios.post(`/api/portais/removelogo`, {url: this.imagemUrl, id: this.noticiaId})
                        .then(response => {
                            this.image = '';
                            this.$toasted.global.error('Logo removido!');
                            location.href = '/portais';
                        })
                        .catch(error => {
                            this.errors = error.response.data.errors;
                            this.submiting = false
                        })
                } else {
                    this.image = '';
                    document.getElementById("inputFile").value = "";
                }
            },
            openFile() {
                document.getElementById("inputFile").click();
            }
        }
    }
</script>
