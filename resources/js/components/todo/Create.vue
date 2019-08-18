<template>
  <div class="row mt-4 mb-3">
    <div class="col-sm-6">
      <form @submit.prevent="add">
        <div class="d-flex mr-2">
          <input
            v-model="form.description"
            name="description"
            v-validate="'required'"
            class="form-control w-50 mr-3"
          />
          <button type="submit" class="btn btn-primary">Add Todo</button>
        </div>
      </form>
      <div v-show="errors.has('description')" class="error-span">Please enter your todo.</div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        description: ""
      },
      submitting: false
    };
  },
  methods: {
    async add() {
      if (!(await this.$validator.validate())) {
        return;
      }
      this.submitting = true;
      await axios.post("/api/todos", this.form);
      this.submitting = false;
      this.$emit('added', this.form)
      this.$notify({
        title: 'Success!',
        text: 'Todo added!'
      });
      this.form.description = "";
      this.$validator.reset();
    }
  }
};
</script>
<style>
.error-span {
  width: 100%;
  margin-top: 0.25rem;
  font-size: 80%;
  color: #e3342f;
}
</style>