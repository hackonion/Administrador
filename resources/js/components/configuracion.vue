<template>

<div>
<!-- Editar-->
<form   @submit.prevent="editar(dato)" v-if="editarTexto">
    <div class="card" id = "agregar">
      <div class="card-header">
      Agregar puesto
      </div>
      <div class="card-body">
        <div class="row">
          <div class = "col">
            <h5>Indice</h5>

            <input type="text" maxlength="18" 
           class="form-control mb-2" v-model="dato.ident_puestos" disabled>

            <h5>Clave del puesto</h5>

            <input type="text" maxlength="18" placeholder="Clave del puesto"
           class="form-control mb-2" v-model="dato.clv_Puesto">

           <h5>Nombre</h5>

            <input type="text" placeholder="Nombre"
           class="form-control mb-2" v-model="dato.nombre">
           
            <button class="btn btn-primary" type="submit" >Editar</button>
            <button class="btn btn-danger" @click.prevent="cancel">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
<!--Agregar-->
<form  @submit.prevent="agregar" v-else>
    <div class="card" id = "agregar">
      <div class="card-header">
      Agregar puesto
      </div>
      <div class="card-body">
        <div class="row">
          <div class = "col">
            <h5>Clave del puesto</h5>

            <input type="text" maxlength="18" placeholder="Clave del puesto"
           class="form-control mb-2" v-model="dato.clv_Puesto">

           <h5>Nombre</h5>

            <input type="text" placeholder="Nombre"
           class="form-control mb-2" v-model="dato.nombre">
           
            <button class="btn btn-primary" type="submit">Agregar</button>
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
            <th scope="col">Indice</th>
            <th scope="col">Clave puesto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item,index) in filtro.slice().reverse()" :key="index">
            <td>{{item.ident_puestos}}</td>
            <td>{{item.clv_Puesto}}</td>
            <td>{{item.nombre}}</td>
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
        return {
            dato:{ident_puestos:'',clv_Puesto:'',nombre:''},
            datos:[],
            textSearch:"",
            editarTexto: false,
        }
    },
    
    created(){
      this.getConfiguracion();
    },
    computed:{
      filtro: function() {
       var textSearch = this.textSearch;
       return this.datos.filter((dato)=> {
         return dato.nombre.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1;
       });
     },
    },
    methods: {
         getConfiguracion: function(){
        axios.get('/configuracion')
          .then(function (response) {
            this.datos = response.data;
            }.bind(this));
      },
      agregar:function (){
          const params = {clv_Puesto:this.dato.clv_Puesto,nombre:this.dato.nombre};
          this.dato.clv_Puesto ='';
          this.dato.nombre = '';

           axios.post('/configuracion',params)
            .then( res=>{
                this.getConfiguracion();

            });
      },
       eliminar: function (item,index){
        console.log( index,item.ident_puestos);

       axios.delete(`/configuracion/${item.ident_puestos}`)
          .then(()=>{
            this.getConfiguracion();
            
        })
      },

       editarF(item){
          this.editarTexto = true;
          this.dato.ident_puestos = item.ident_puestos;
          this.dato.clv_Puesto = item.clv_Puesto;
          this.dato.nombre = item.nombre;
        },
        cancel(){
        this.editarTexto = false;
        this.dato = {ident_puestos:'',clv_Puesto:'',nombre:''};
    },
editar(dato){
             const params = {ident_puestos:this.dato.ident_puestos,clv_Puesto:this.dato.clv_Puesto,nombre:this.dato.nombre};

            axios.put(`/configuracion/${dato.ident_puestos}`,params)
            .then(res =>{
            this.editarTexto = false;  
            const index = this.datos.findIndex(tareaBuscar => tareaBuscar.ident_puestos
            === res.data.ident_puestos)
            this.datos[index] = res.data;
            this.dato = {ident_puestos:'',clv_Puesto:'',nombre:''};
            axios.get('/configuracion')
                .then(res => {
            this.datos = res.data;            
            })
        })    
    },
      
    }
}
</script>