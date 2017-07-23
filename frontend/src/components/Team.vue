<template>
  <form @submit.prevent="createTeam">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3>Equipo<strong>*</strong></h3>
      </div>   
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
          <label>Nombre</label>
          <input type="text" class="form-control" v-model="team" placeholder="Introduce el nombre de tú equipo" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
          <label>Robot</label>
          <input type="text" class="form-control" v-model="robot" placeholder="Introduce el nombre de tú robot" required>
        </div>
      </div>
      <professor></professor>
    </div>
    <alumn></alumn>
    <button type="submit" class="btn btn-primary pull-right">Registrar Equipo</button>    
  </form>
</template>

<script>
import Professor from './Professor'
import Alumn from './Alumn'
import axios from 'axios'
const BASE_URL = 'http://localhost:8000'

export default {
  components: {
    Professor,
    Alumn
  },
  data () {
    return {
      team: null,
      robot: null
    }
  },
  methods: {
    createTeam () {
      axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest'
      }

      let team = null
      let robot = null
      let professor = null
      let alumns = []

      if ((this.team !== '' || this.team !== null)) {
        team = this.team
      }

      if ((this.robot !== '' || this.robot !== null)) {
        robot = this.robot
      }

      if ((this.$store.state.selectedProfessor === 0) && (this.$store.state.professor.name !== '' || this.$store.state.professor.name !== null) && (this.$store.state.professor.firstLastName !== '' || this.$store.state.professor.firstLastName !== null) && (this.$store.state.professor.email !== '' || this.$store.state.professor.email !== null)) {
        professor = {
          name: this.$store.state.professor.name,
          firstLastName: this.$store.state.professor.firstLastName,
          secondLastName: this.$store.state.professor.secondLastName,
          email: this.$store.state.professor.email
        }
      } else if (this.$store.state.selectedProfessor > 0) {
        professor = this.$store.state.selectedProfessor
      }

      if ((this.$store.state.alumn.noControl !== '' || this.$store.state.alumn.noControl !== null) && (this.$store.state.alumn.name !== '' || this.$store.state.alumn.name !== null) && (this.$store.state.alumn.firstLastName !== '' || this.$store.state.alumn.firstLastName !== null) && (this.$store.state.alumn.email !== '' || this.$store.state.alumn.email !== null) && (this.$store.state.alumn.selectedCareer > 0) && (parseInt(this.$store.state.alumn.semester) > 0)) {
        alumns = {
          noControl: this.$store.state.alumn.noControl,
          name: this.$store.state.alumn.name,
          firstLastName: this.$store.state.alumn.firstLastName,
          secondLastName: this.$store.state.alumn.secondLastName,
          email: this.$store.state.alumn.email,
          selectedCareer: this.$store.state.alumn.selectedCareer,
          semester: parseInt(this.$store.state.alumn.semester)
        }
      }

      let teamData = { team, robot, professor, alumns }

      axios.post(BASE_URL + '/api/create/new/team', teamData)
           .then(function (response) {
             console.log(response)
           })
           .catch(function (error) {
             console.log(error)
           })
      // Clean form
      this.clearForm()
      // if (this.newProfessor) {
      //   this.fetchProfessors()
      //   this.newProfessor = false
      // }
    },
    clearForm () {
      this.team = ''
      this.robot = ''
      this.$store.state.selectedProfessor = 0
      this.$store.state.name = null
      this.$store.state.firstLastName = null
      this.$store.state.secondLastName = null
      this.$store.state.email = null
      this.$store.state.alumn.noControl = ''
      this.$store.state.alumn.name = ''
      this.$store.state.alumn.firstLastName = ''
      this.$store.state.alumn.secondLastName = ''
      this.$store.state.alumn.email = ''
      this.$store.state.alumn.selectedCareer = 0
      this.$store.state.alumn.semester = 0
    }
  }
}
</script>
