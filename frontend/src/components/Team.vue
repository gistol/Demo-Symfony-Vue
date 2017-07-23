<template>
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
</template>

<script>
import Professor from './Professor'

export default {
  components: {
    Professor
  },
  computed: {
    team: {
      get () {
        return this.$store.state.team.name
      },
      set (value) {
        this.$store.commit('updateTeamName', value)
      }
    },
    robot: {
      get () {
        return this.$store.state.robot.name
      },
      set (value) {
        this.$store.commit('updateRobotName', value)
      }
    }
  }
}
</script>
