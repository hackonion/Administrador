<template>
     <div>
      <FlashMessage></FlashMessage>
       <!--edicion-->
       <form @submit.prevent="edit(equipo)" v-if="editText">
        <div class="card" >
            <div class="card-header">
                Inventario de  equipo
            </div>
            <div class="card-body">
               <input type="text" maxlength="18" 
           class="form-control mb-2" v-model="equipo.id" disabled>

                <h5>No. de serie</h5>
                    <input type="text" placeholder="Ingresa la serie"
                    class="form-control mb-2" v-model="equipo.serie">
                
                <h5>Modelo</h5>
                    <input type="text" placeholder="Ingresa el modelo"
                    class="form-control mb-2" v-model="equipo.modelo">

                <h5>Marca</h5>
                    <input type="text" placeholder="Ingresa la marca"
                    class="form-control mb-2" v-model="equipo.marca">
                <h5>Tipo</h5>
                    <input type="text" placeholder="Ingresa el modelo"
                    class="form-control mb-2" v-model="equipo.tipo">
                    
                <button class="btn btn-primary" type="submit" >Editar</button>
                <button class="btn btn-danger" @click.prevent="cancel">Cancelar</button>
            </div>
        </div>
         </form>
       <!--agregar-->
         <form @submit.prevent="agregarEquipo" v-else>
        <div class="card" >
            <div class="card-header">
                Inventario de  equipo
            </div>
            <div class="card-body">

                <h5>No. de serie</h5>
                    <input type="text" placeholder="Ingresa la serie"
                    class="form-control mb-2" v-model="equipo.serie">
                
                <h5>Modelo</h5>
                    <input type="text" placeholder="Ingresa el modelo"
                    class="form-control mb-2" v-model="equipo.modelo">

                <h5>Marca</h5>
                    <input type="text" placeholder="Ingresa la marca"
                    class="form-control mb-2" v-model="equipo.marca">

                 <h5>Tipo</h5>
                    <input type="text" placeholder="Ingresa el modelo"
                    class="form-control mb-2" v-model="equipo.tipo">
                <button class="btn btn-primary" id="ag" type="submit">Agregar</button>
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
            <th scope="col">Indice</th>
            <th scope="col">No. de serie</th>
            <th scope="col">Modelo</th>
            <th scope="col">Marca</th>
            <th scope="col">Tipo</th>
            <th scope="col">Fecha alta</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item,index) in filtro.slice().reverse()" :key="index">
            <td>{{item.id}}</td>
            <td>{{item.serie}}</td>
            <td>{{item.modelo}}</td>
            <td>{{item.marca}}</td>
            <td>{{item.tipo}}</td>
            <td>{{item.fec_alt}}</td>
            <td><button class="btn btn-danger btn-sm" @click="eliminar(item,index)">Eliminar</button></td>
            <td><button class="btn btn-warning" type="submit" @click="editarF(item)">Editar</button></td>
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
            equipos:[],
            equipo:{id:'',serie:'',modelo:'',marca:'',tipo:'',fec_alt:''},
            textSearch:"",
            editText: false,
            
        }
    },
    created(){
        this.getEquipo();
    },
    computed:{
        filtro: function() {
       var textSearch = this.textSearch;
       return this.equipos.filter((equipo)=> {
         return equipo.serie.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1;
       });
     },
    },
    methods:{
        getEquipo: function(){
        axios.get('/equipo')
          .then(function (response) {
            this.equipos = response.data;
            }.bind(this));
      },

      agregarEquipo:function(){
          const params = {serie:this.equipo.serie,modelo:this.equipo.modelo,marca:this.equipo.marca,tipo:this.equipo.tipo}
          if(this.equipo.serie == '' ||
             this.equipo.modelo == '' ||
             this.equipo.marca == '' ||
             this.equipo.tipo == '')
             {
               this.flashMessage.warning({title: 'Info', 
                  message: 'Por favor llene todos los campos',
                  time:1500});
                 return;
             }
          this.equipo.serie = "";
          this.equipo.modelo = "";
          this.equipo.marca = "";
          this.equipo.tipo = "";
          axios.post('/equipo',params)
            .then( res=>{
                this.getEquipo();
                this.flashMessage.success({title: 'Success', 
                  message: 'Se a agregado',
                  time:1500});

            });
      },
      eliminar:function(item,index){
        console.log(index,item.id);

         axios.delete(`/equipo/${item.id}`)
          .then(()=>{
            this.getEquipo();
            this.flashMessage.error({title:'Eliminado',
              message:'Se elimino de la lista',
              time:1500});
            
        })
      },
       editarF(item){
         this.editText = true;
         this.equipo.id = item.id
          this.equipo.serie = item.serie;
          this.equipo.modelo = item.modelo;
          this.equipo.marca = item.marca;
          this.equipo.tipo = item.tipo;
       },

       cancel(){
        this.editText = false;
        this.equipo.serie = "";
        this.equipo.modelo = "";
        this.equipo.marca = "";
        this.equipo.tipo="";
    },
    edit(equipo){
             const params = {id:this.equipo.id,serie:this.equipo.serie,modelo:this.equipo.modelo,marca:this.equipo.marca,tipo:this.equipo.tipo}

            axios.put(`/equipo/${equipo.id}`,params)
            .then(res =>{
            this.editText = false;  
            const index = this.equipos.findIndex(buscar => buscar.id
            === res.data.id)
            this.equipos[index] = res.data;
            this.equipo = {id:'',serie:'',modelo:'',marca:'',tipo:'',fec_alt:''};
            axios.get('/equipo')
                .then(res => {
              this.equipos = res.data;  
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