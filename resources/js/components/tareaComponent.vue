
<template>
<div>
  <!--Editar-->
  <form  @submit.prevent="editar(tarea)" v-if="editarTexto">
    <div class="card" id = "agregar">
      <div class="card-header">
      Editar trabajadores
      </div>
      <div class="card-body">
        <div class="row">
          <div class = "col">
            <h5>Clave trabajador</h5>

            <input type="text" maxlength="18"
           class="form-control mb-2" v-model="tarea.clv_trab">
           
           <h5>Clave de sucursal</h5>
           <select class = "form-control mb-2" @change = "getSucursal()" v-model="sucursal">
              <option v-for="(item,index) in sucursales" :key="index" v-bind:value="item.clv_Sucursal">
              {{item.nombre}}
              </option>
            </select>

            <h5>Clave de puesto</h5>
            
            <select class = "form-control mb-2" @change = "getPuestos()"  v-model="puesto" >
              <option v-for="(item,index) in puestos" :key="index" v-bind:value="item.clv_Puesto"> 
                {{item.nombre}}
              </option>
   
            </select>
          </div>
          <div class = "col">
            <h5>Nombre</h5>

            <input type="text" placeholder="Nombre"
           class="form-control mb-2" v-model="tarea.nombre">

            <h5>Apellido paterno</h5>
            <input type="text" placeholder="Apellido paterno"
           class="form-control mb-2" v-model="tarea.paterno">
           
            <h5>Apellido materno</h5>
            <input type="text" placeholder="Apellido materno"
           class="form-control mb-2" v-model="tarea.materno">

            <button class="btn btn-primary" type="submit" >Editar</button>
            <button class="btn btn-danger" 
              @click="cancelarEdicion">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
<!--Agregar-->
<form  @submit.prevent="agregar" v-else>
    <div class="card" id = "agregar">
      <div class="card-header">
      Agregar trabajadores
      </div>
      <div class="card-body">
        <div class="row">
          <div class = "col">
            <h5>Clave trabajador</h5>

            <input type="text" maxlength="18"
           class="form-control mb-2" v-model="tarea.clv_trab">
           
           <h5>Clave de sucursal</h5>
           <select class = "form-control mb-2" @change = "getSucursal()" v-model="sucursal">
              <option v-for="(item,index) in sucursales" :key="index" v-bind:value="item.clv_Sucursal">
              {{item.nombre}}
              </option>
            </select>

            <h5>Clave de puesto</h5>
            
            <select class = "form-control mb-2" @change = "getPuestos()"  v-model="puesto" >
              <option v-for="(item,index) in puestos" :key="index" v-bind:value="item.clv_Puesto"> 
                {{item.nombre}}
              </option>
   
            </select>
          </div>
          <div class = "col">
            <h5>Nombre</h5>

            <input type="text" placeholder="Nombre"
           class="form-control mb-2" v-model="tarea.nombre">

            <h5>Apellido paterno</h5>
            <input type="text" placeholder="Apellido paterno"
           class="form-control mb-2" v-model="tarea.paterno">
           
            <h5>Apellido materno</h5>
            <input type="text" placeholder="Apellido materno"
           class="form-control mb-2" v-model="tarea.materno">

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
            <th scope="col">Clave trabajador</th>
            <th scope="col">Clave sucursal</th>
            <th scope="col">Clave puesto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido paterno</th>
            <th scope="col">Apellido materno</th>
            <th scope="col">Fecha alta</th>
            <th scope="col">Eliminar</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item,index) in filtro.slice().reverse()" :key="index">
            <td>{{item.clv_trab}}</td>
            <td>{{item.clvE_sucursal}}</td>
            <td>{{item.clvE_puesto}}</td>
            <td>{{item.nombre}}</td>
            <td>{{item.paterno}}</td>
            <td>{{item.materno}}</td>
            <td>{{item.fec_ing}}</td>
            <td><button class="btn btn-danger btn-sm" @click="eliminar(item,index)">Eliminar</button></td>
            <td><button class="btn btn-warning" type="submit" @click="editarFormulario(item)">Editar</button></td>
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
            tareas: [],
            tarea:{clv_trab:'',clvE_sucursal:'',clvE_puesto:'',nombre:'',paterno:'',materno:'',fec_ing:''},

            lasts:[],
            last:{clv_trab:''},

            puestos: [],
            puesto:{clv_Puesto:'',nombre: ''},

            sucursales:[],
            sucursal:{clv_Sucursal:'',nombre:''},
            editarTexto: false,

            textSearch:""
        }
    },
    created(){
      this.getPuestos();
      this.getSucursal();
      this.getTareas();
    /*  this.getLast();*/

     
    },
     computed: {
     filtro: function() {
       var textSearch = this.textSearch;
       return this.tareas.filter((tarea)=> {
         return tarea.nombre.toLowerCase().indexOf(textSearch.toLowerCase()) !== -1;
       });
     },
     /*namelast:function (){
       var data = parseInt(this.lasts.clv_trab);
       data = data+1;
       return `${data}`
     },*/

  },
    methods:{
      getPuestos: function (){
        axios.get('/getPuestos')
          .then(function (response) {
            this.puestos = response.data;
            }.bind(this));
      },

      getTareas: function(){
        axios.get('/acceso')
          .then(function (response) {
            this.tareas = response.data;
            }.bind(this));
      },
      getSucursal: function(){
        axios.get('/getSucursales')
          .then(function (response) {
            this.sucursales = response.data;
            }.bind(this));
      },
     /* getLast: function(){
        axios.get('/getLast')
          .then(function (response) {
            this.lasts = response.data;
            }.bind(this));*/
            
      
      agregar: function (){
            /*var data = parseInt(this.lasts.clv_trab);
            data = data+1;*/
            
            console.log(this.tarea.clv_trab,this.sucursal,this.puesto,this.tarea.nombre,
             this.tarea.paterno,this.tarea.materno);

          const params = {clv_trab:this.tarea.clv_trab,clvE_sucursal:this.sucursal,clvE_puesto:this.puesto,
            nombre:this.tarea.nombre,paterno:this.tarea.paterno,materno:this.tarea.materno}

            this.tarea.clv_trab = '';
            this.puesto='';
            this.sucursal='';
            this.tarea.nombre = '';
            this.tarea.paterno='';
            this.tarea.materno='';

            axios.post('/acceso',params)
            .then( res=>{
                this.tareas.push(res.data);

            });
          
         
      },

      eliminar: function (item,index){
        console.log( index,item.clv_trab);

       axios.delete(`/acceso/${item.clv_trab}`)
          .then(()=>{
            this.getTareas();
            
        })
      },
       editarFormulario(item){
            this.editarTexto = true;
            this.tarea.clv_trab = item.clv_trab;
            this.puesto= item.clvE_puesto;
            this.sucursal= item.clvE_sucursal;
            this.tarea.nombre = item.nombre;
            this.tarea.paterno= item.paterno;
            this.tarea.materno= item.materno;
            
        },
      editar(tarea){
             const params = {clv_trab:this.tarea.clv_trab,clvE_sucursal:this.sucursal,clvE_puesto:this.puesto,
            nombre:this.tarea.nombre,paterno:this.tarea.paterno,materno:this.tarea.materno}

            axios.put(`/acceso/${tarea.clv_trab}`,params)
            .then(res =>{
            this.editarTexto = false;  
            const index = this.tareas.findIndex(tareaBuscar => tareaBuscar.clv_trab
            === res.data.clv_trab)
            this.tareas[index] = res.data;
            this.tarea.clv_trab = '';
            this.puesto='';
            this.sucursal='';
            this.tarea.nombre = '';
            this.tarea.paterno='';
            this.tarea.materno='';
            axios.get('/acceso')
                .then(res => {
            this.tareas = res.data;            
            })
        })
    },
      cancelarEdicion(){
      this.editarTexto = false;
      
            this.tarea.clv_trab = '';
            this.puesto='';
            this.sucursal='';
            this.tarea.nombre = '';
            this.tarea.paterno='';
            this.tarea.materno='';
    }
      

    
    }
}

</script>