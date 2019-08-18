<template>
  <section>
    <create @added="fetch"></create>
    <div class="row">
      <div class="col-sm-6">
        <ul class="list-group" v-if="todos.length">
          <li class="list-group-item" v-for="(todo,index) in todos" :key="todo.id">
            <div class="d-flex justify-content-between align-items-center">
              <span
                class="span-description"
                :class="{'completed' : todo.status === 1}"
              >{{todo.description}}</span>
              <div class="d-flex justify-content-between">
                <button
                  @click.prevent="complete(todo,index)"
                  :disabled="loading"
                  class="btn btn-success mr-2"
                  v-show="todo.status === 0"
                >Complete</button>
                <button
                  @click.prevent="remove(todo,index)"
                  :disabled="loading"
                  class="btn btn-danger"
                >Remove</button>
              </div>
            </div>
          </li>
        </ul>
        <p v-if="! todos.length && !loading">No more todos!</p>
      </div>
    </div>
  </section>
</template>

<script>
import Create from "./Create";
export default {
  components: { Create },
  data() {
    return {
      todos: [],
      loading: false
    };
  },
  mounted() {
    this.fetch();
  },
  methods: {
    async fetch() {
      this.loading = true;
      this.todos = (await axios.get("/api/todos")).data.data;
      this.loading = false;
    },
    async complete(todo, index) {
      this.loading = true;
      let updatedTodo = (await axios.post(`/api/todos/${todo.id}/complete`))
        .data.data;
      this.todos.splice(index, 1, updatedTodo);
      this.loading = false;
      this.$notify({
        title: "Success!",
        text: "Todo completed!"
      });
    },
    async remove(todo, index) {
      this.loading = true;
      await axios.delete(`/api/todos/${todo.id}`);
      this.todos.splice(index, 1);
      this.loading = false;
      this.$notify({
        title: "Success!",
        text: "Todo removed!"
      });
    }
  }
};
</script>
<style>
.span-description.completed {
  text-decoration: line-through;
}
</style>