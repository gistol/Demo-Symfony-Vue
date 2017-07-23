<template>
  <div v-if="getTotalAlumns > 0" class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h3>Lista de integrantes<strong></strong></h3>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <table class="table">
        <thead>
          <tr>
            <th>No. Control</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Email</th>
            <th>Carrera</th>
            <th>Semestre</th>
        	</tr>
        </thead>
      	<tbody>
      		<tr v-for="alumn in alumns" key="alumn.id" :alumn.sync="alumn">
                <td>{{ alumn.noControl }}</td>
                <td>{{ alumn.name }}</td>
                <td>{{ alumn.firstLastName }}</td>
                <td>{{ alumn.secondLastName }}</td>
                <td>{{ alumn.email }}</td>
                <td>{{ alumn.selectedCareer }}</td>
                <td>{{ alumn.semester }}</td>
      		</tr>
      	</tbody>
      </table>
    </div>
  </div>	
</template>

<script>
export default {
  props: ['alumns'],
  computed: {
    getTotalAlumns () {
      return this.$store.state.alumns.length
    }
  }
}
</script>
