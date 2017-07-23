<template>
  <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h2><strong>Registro</strong></h2>
      <p class="lead blog-description">Las secciones con <strong>*</strong> son requeridas para un registro válido.</p>
      <team></team>
    </div>
  </div>
</template>

<script>
import Team from './components/Team'

export default {
  name: 'app',
  components: {
    Team
  }
}
</script>
