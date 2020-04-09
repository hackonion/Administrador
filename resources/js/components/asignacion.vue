<template>
    <div>
        <!--editar-->
         <form @submit.prevent="editE(catalogo)" v-if="editarTexto">
        <div class="card" >
            <div class="card-header">
                Asignar equipo
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col">
                  <input type="text" maxlength="18" 
                  class="form-control mb-2" v-model="catalogo.id" disabled>
                <h5>Usuario</h5>
                <select class = "form-control mb-2"     v-model="usuario" placeholder="Usuario">
                      <option v-for="(item,index) in usuarios" :key="index" v-bind:value="item.nombre">
                        {{item.nombre}}    
                      </option> 
                </select>

                <h5>Contraseña</h5>
                    <input type="text" v-model="catalogo.pass" placeholder="Ingresa contraseña"
                    class="form-control mb-2">

                <h5>Equipo</h5>
               <select class = "form-control mb-2"    v-model="equipo" placeholder="Equipo">
                      <option v-for="(item,index) in equipos" :key="index" v-bind:value="item.serie">
                        {{item.serie}}    
                      </option> 
                    </select>
              </div>
                <div class="col">
                <h5>Direccion IP</h5>
                    <input type="text" v-model="catalogo.dir_ip" placeholder="Dirección IP"
                    class="form-control mb-2">

                <h5>Programas</h5>
                    <textarea  class="form-control mb-2" v-model="catalogo.programas" row="5" placeholder="Agrega los programas del equipo"></textarea>
               <button class="btn btn-primary" type="submit" >Editar</button>
                <button class="btn btn-danger" @click.prevent="cancel">Cancelar</button>
                </div>
              </div>
            </div>
        </div>
        </form>

        <!--agrgar-->
        <form @submit.prevent="agregar" v-else>
       <FlashMessage></FlashMessage>
        <div class="card" >
            <div class="card-header">
                Asignar equipo
            </div>
            <div class="card-body">
            <div class="row">
             
              <div class="col">
                <h5>Usuario</h5>
                <select class = "form-control mb-2"     v-model="usuario" placeholder="Usuario">
                      <option v-for="(item,index) in usuarios" :key="index" v-bind:value="item.nombre">
                        {{item.nombre}}    
                      </option> 
                </select>
                   

                <h5>Contraseña</h5>
                    <input type="text" v-model="catalogo.pass" placeholder="Ingresa contraseña"
                    class="form-control mb-2">

                <h5>Equipo</h5>
               <select class = "form-control mb-2"    v-model="equipo" placeholder="Equipo">
                      <option v-for="(item,index) in equipos" :key="index" v-bind:value="item.serie">
                        {{item.serie}}    
                      </option> 
                    </select>
              </div>
              <div class="col">
                <h5>Direccion IP</h5>
                    <input type="text" v-model="catalogo.dir_ip" placeholder="Dirección IP"
                    class="form-control mb-2">

                <h5>Programas</h5>
                    <textarea  class="form-control mb-2" type="text" v-model="catalogo.programas" row="5" placeholder="Agrega los programas del equipo"></textarea>
                <button class="btn btn-primary" id="ag" type="submit">Agregar</button>
              </div>
            </div>
            </div>
        </div>
        </form>

<div>
    <div>
      <h5>Buscar</h5>
      <input id="input-search" type="text" class="form-control" v-model="textSearch" placeholder='Buscar...'>
    </div>
</div>

     <div class="tableFixHead">
      <table class="table">
        <thead class="thead-dark ">
          <tr>
            <th scope="col">Ident</th>
            <th scope="col">Usuario</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Equipo</th>
            <th scope="col">Direccion ip</th>
            <th scope="col">Programas</th>
            <th scope="col">Fecha alta</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item,index) in filtro.slice().reverse()" :key="index">
            <td>{{item.id}}</td>
            <td>{{item.usuario}}</td>
            <td>{{item.pass}}</td>
            <td>{{item.equipo}}</td>
            <td>{{item.dir_ip}}</td>
            <td>{{item.programas}}</td>
            <td>{{item.fec_alt}}</td>
            <td><button class="btn btn-danger btn-sm" @click="eliminar(item,index)">Eliminar</button></td>
            <td><button class="btn btn-warning" type="submit" @click="edit(item)">Editar</button></td>
          </tr>
        </tbody>
      </table>
    </div>



    </div>
</template>
<script>
export default {
    
    data(){
        return{
            
            usuarios:[],
            usuario:{clv_trab:'',nombre:'',},
            
            equipos:[],
            equipo:{id:'',serie:''},
            
            catalogo:{id:'',usuario:'',pass:'',equipo:'',dir_ip:'',programas:''},
            catalogos:[],
            textSearch:'',
            editarTexto:false,
        }
    },
    created(){
        this.getCatalogo();
        this.getUsuarios();
        this.getEquipos();
        
        
    },
    computed: {
         filtro: function() {
       var textSearch = this.textSearch;
       return this.catalogos.filter((catalogo)=> {
         return catalogo.usuario.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1;
       });
     },

    },
    methods:{
        getUsuarios: function(){
            axios.get('/getUsuarios')
          .then(function (response) {
            this.usuarios = response.data;
            }.bind(this));
        },
        getEquipos: function(){
        axios.get('/getEquipos')
          .then(function (response){
          this.equipos = response.data;
          }.bind(this));
    },
    getCatalogo: function(){
            axios.get('/asignacion')
          .then(function (response) {
            this.catalogos = response.data;
            }.bind(this));
        },
    agregar: function (){
            
            
           // console.log(this.usuario,this.catalogo.pass,this.equipo,this.catalogo.dir_ip,this.catalogo.programas);
            if(this.usuario ==''|| this.catalogo.pass==''||
               this.equipo ==''||this.catalogo.dir_ip =='')
               {
                  this.flashMessage.warning({title: 'Info', 
                  message: 'Por favor llene todos los campos',
                  time:1500});
                 return;

               }

            const params = {
            usuario:this.usuario,
            pass:this.catalogo.pass,
            equipo:this.equipo,
            dir_ip:this.catalogo.dir_ip,
            programas:this.catalogo.programas};

            this.usuario = "";
            this.catalogo.pass = "";
            this.equipo = "";
            this.catalogo.dir_ip = "";
            this.catalogo.programas = "";


            axios.post('/asignacion',params)
            .then( res=>{
              this.catalogos.push(res.data);
                 this.flashMessage.success({title: 'Success', 
                  message: 'Se asigno el equipo',
                  time:1500});
              
          

                
               

            });
    },
     eliminar:function(item,index){
        console.log(index,item.id);

         axios.delete(`/asignacion/${item.id}`)
          .then(()=>{
           
              this.getCatalogo();
              this.flashMessage.error({title:'Eliminado',
              message:'Se elimino de la lista',
              time:1500});
            
            
            
        })
      },
    edit(item)
    {
        this.editarTexto = true;
        this.catalogo.id = item.id
        this.usuario = item.usuario;
        this.catalogo.pass = item.pass;
        this.equipo = item.equipo;
        this.catalogo.dir_ip = item.dir_ip;
        this.catalogo.programas = item.programas;

    },
    cancel(){
        this.editarTexto = false;
        this.usuario = "";
        this.catalogo.pass = "";
        this.equipo = "";
        this.catalogo.dir_ip = "";
        this.catalogo.programas = "";
    },

    editE(catalogo){
            const params = {
            id:this.catalogo.id,
            usuario:this.usuario,
            pass:this.catalogo.pass,
            equipo:this.equipo,
            dir_ip:this.catalogo.dir_ip,
            programas:this.catalogo.programas};

            axios.put(`/asignacion/${catalogo.id}`,params)
            .then(res =>{
            this.editarTexto = false;  
            const index = this.catalogos.findIndex(buscar => buscar.id
            === res.data.id)
            this.catalogos[index] = res.data;
           
            this.usuario = "";
            this.catalogo.pass = "";
            this.equipo = "";
            this.catalogo.dir_ip = "";
            this.catalogo.programas = "";
            axios.get('/asignacion')
                .then(res => {
              this.catalogos = res.data;  
              this.flashMessage.success({title: 'Success', 
                  message: 'Se edito el elemento',
                  time:1500});
                 return;       
            })
        })    
    },
      
    }

    
    }
</script>
