<template>
  <div class="is-flex is-justify-content-space-between is-align-items-center">
    <h1 class="m-0">{{ title }}</h1>
    <div>
      <button class="button is-primary" @click="addForm()">Add User</button>
    </div>
  </div>

  <!-- for table  -->
  <div class="w-full" style="min-height: 50vh">
    <div v-if="isLoading" class="isLoading">
      <pulse-loader :loading="isLoading" ></pulse-loader>
    </div>
    <div class="mt-5" style="border: solid #f3f3f3;" v-else>
      <table class="table is-striped">
        <thead>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Birth Date</th>
          <th>Option</th>
        </thead>
        <tbody>
          <tr v-for="user, key in users" :key="key">
            <td>{{ key + 1 }}</td>
            <td>{{ user?.first_name }}</td>
            <td>{{ user?.last_name }}</td>
            <td>{{ user?.email }}</td>
            <td>{{ user?.phone }}</td>
            <td>{{ moment(user?.birth_date) }}</td>
            <td>
              <div style="display: flex; gap: 5px; justify-content: center;">
                <a href="#" @click="editForm(user.id)"><i class="fas fa-edit has-text-info"></i></a>
                <a href="#" @click="deleteForm(user?.id, user?.first_name)"><i class="fas fa-trash has-text-danger"></i></a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div v-if="isModal"> 
    <div class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-content">
        <h3>Add New User</h3>
        <div class="mt-2">
          <form ref="userForm" v-on:submit.prevent="submitForm">
            <div class="field">
              <label>First Name</label>
              <div v-if="errors?.first_name?.length > 0">
                <div class="control has-icons-right">
                  <input class="input is-danger" type="text" placeholder="Last Name" v-model="form.first_name">
                  <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                  </span>
                </div>
                <div v-for="error in errors.first_name" :key="error">
                  <p class="help is-danger">{{ error }}</p>
                </div>
              </div>
              <div v-else>
                <input class="input" required placeholder="First Name" v-model="form.first_name" />
              </div>
            </div>

            <div class="field">
              <label>Last Name</label>
              <div v-if="errors?.last_name?.length > 0">
                <div class="control has-icons-right">
                  <input class="input is-danger" type="text" placeholder="Last Name" v-model="form.last_name">
                  <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                  </span>
                </div>
                <div v-for="error in errors.last_name" :key="error">
                  <p class="help is-danger">{{ error }}</p>
                </div>
              </div>
              <div v-else>
                <input class="input" required placeholder="First Name" v-model="form.last_name" />
              </div>

            </div>

            <div class="field">
              <label>Email</label>
              <div v-if="errors?.email?.length > 0">
                <div class="control has-icons-right">
                  <input class="input is-danger" type="text" placeholder="Email" v-model="form.email">
                  <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                  </span>
                </div>
                <div v-for="error in errors.email" :key="error">
                  <p class="help is-danger">{{ error }}</p>
                </div>
              </div>
              <div v-else>
                <input class="input" type="email" required placeholder="Email" v-model="form.email" />
              </div>
            </div>

            <div class="field">
              <label>Phone</label>
              <div v-if="errors?.phone?.length > 0">
                <div class="control has-icons-right">
                  <input class="input is-danger" type="text" placeholder="Phone" v-model="form.phone">
                  <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                  </span>
                </div>
                <div v-for="error in errors.phone" :key="error">
                  <p class="help is-danger">{{ error }}</p>
                </div>
              </div>
              <div v-else>
                <input class="input" required placeholder="Phone" v-model="form.phone" />
              </div>
            </div>

            <div class="field" v-if="formType === 'newuser'">
              <label>Password</label>
              <div v-if="errors?.password?.length > 0">
                <div class="is-flex w-full" style="gap: 5px">
                  <div class="control has-icons-right w-full">
                    <input class="input is-danger" :type="passwordType" placeholder="Password" v-model="form.password">
                    <span class="icon is-small is-right">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                  </div>
                  <button class="button is-link" @click="changePassType" type="button">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
                <div v-for="error in errors.password" :key="error">
                  <p class="help is-danger">{{ error }}</p>
                </div>
              </div>
              <div v-else>
                <!-- <input class="input" :type="passwordType" required placeholder="Password" v-model="form.password" /> -->
                <div class="is-flex w-full" style="gap: 5px">
                  <input class="input" :type="passwordType" placeholder="Password" v-model="form.password" />
                  <button class="button is-link" @click="changePassType" type="button">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="field">
              <label>Birth Date</label>
              <div v-if="errors?.birth_date?.length > 0">
                <Datepicker v-model="form.birth_date" :state="false" :enable-time-picker="false" :maxDate="new Date()"></Datepicker>
                <div v-for="error in errors.birth_date" :key="error">
                  <p class="help is-danger">{{ error }}</p>
                </div>
              </div>
              <div v-else>
                <Datepicker v-model="form.birth_date" :enable-time-picker="false" :maxDate="new Date()"></Datepicker>
              </div>
            </div>

            <div class="field text-right">
              <div v-if="isLoadingSubmit">
                <button type="submit" disabled class="button is-primary">Saving...</button>
              </div>
              <div v-else>
                <button type="submit" class="button is-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <a href="#" type="button" class="modal-close is-large" @click="closeModal" aria-label="close"></a>
    </div>
  </div>

  <div v-if="isModalDelete">
    <div class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-content">
        <h3>Caution!</h3>
        <p>Are you sure want to delete <strong>{{ deleteUser.name ?? 'this user' }}</strong>?</p>
        <div class="mt-4 is-flex is-justify-content-end" style="gap: 5px">
          <button type="button" @click="isModalDelete = false" class="button is-danger">Nope</button>
          <button v-if="isLoadingDelete" class="button is-primary" disabled >Deleting...</button>
          <button v-else type="button" @click="doDelete()" class="button is-primary" style="padding-left: 50px; padding-right: 50px">Yes!</button>
        </div>
      </div>
    </div>
  </div>

  <Alert v-if="notif.show" :type="notif.type" :message="notif.message" />
  
</template>

<script>
  import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
  import Datepicker from '@vuepic/vue-datepicker';
  import '@vuepic/vue-datepicker/dist/main.css'
  import moment from 'moment';
  import Alert from './Alert.vue';

  export default {
    props: {
      title: String,
    },
    components: {
      PulseLoader,
      Datepicker,
      moment,
      Alert
    },
    data() {
      return {
        users : [],
        isLoading : false,
        isModal: false,
        isModalDelete: false,
        isLoadingSubmit: false,
        isLoadingDelete: false,
        passwordType: 'password',
        formType: null,
        notif: {
          show:true,
          type: '',
          message: ''
        },
        form: {
          id: '',
          first_name: '',
          last_name: '',
          email: '',
          phone: '',
          birth_date: '',
          password: '',
        },
        deleteUser: {
          id: null,
          name: null
        },
        hasErrorForm: false,
        errors: {
          first_name: [],
          last_name: [],
          email: [],
          phone: [],
          birth_date: [],
          password: [],
        }
      }
    },
    created: function() {
      this.getAllData()
    }, 
    methods: {
      moment(date) {
        return moment(new Date(date)).format('ll');
      },
      closeModal() {
        this.clearForm()
        this.isModal = false;
        this.isLoading = false;
      },  
      getAllData: async function() {
        this.isLoading = true;
        await axios.get('/json/user')
              .then(({data}) => {
                this.users = data.data.data;
              }).finally(() => {
                this.isLoading = false;
              })
      },  
      addForm () {
        this.formType = 'newuser';
        this.isModal = true;
      },  
      editForm: async function(id) {
        this.isLoading = true;
        this.formType = 'updateuser';
        await axios.get(`/json/user/${id}`)
              .then(({data}) => {
                this.form.id = data?.data?.id
                this.form.first_name = data?.data?.first_name
                this.form.last_name = data?.data?.last_name
                this.form.email = data?.data?.email
                this.form.phone = data?.data?.phone
                this.form.birth_date = data?.data?.birth_date
                this.form.password = data?.data?.password ?? ''
              })
              .finally(() => {
                this.isModal = true;
              })  
      },
      deleteForm(userId, userName) {
        this.deleteUser.id = userId;
        this.deleteUser.name = userName;
        this.isModalDelete = true;
      },
      doDelete: async function() {
        this.isLoadingDelete = true;
        await axios.post(`json/user/${this.deleteUser.id}/delete`)
              .finally(() => {
                this.deleteUserId = null;
              })
              
        this.isLoadingDelete = false;
        this.isModalDelete = false;
        this.getAllData();
        this.notif.show = true;
        this.notif.type = 'success';
        this.notif.message = 'one user just been removed 😊';
        setTimeout(() => {
          this.notif.show = false;
          this.notif.type = '';
          this.notif.message = '';
        }, 3000)
      },
      submitForm: async function() {
        this.isLoadingSubmit = true;
        let url = null; let message = null;
        if(this.formType === 'newuser') {
          url = '/json/user';
          message = 'Cool, your data has been created! 🎉';
        } else {
          url = `/json/user/${this.form.id}/update`
          message = 'Yeeah, your changes has been saved! 🥳';
        }
        await axios.post(url,this.form)
              .then(() => {
                this.clearForm();
                this.isModal = false;
                this.getAllData();

                this.notif.show = true;
                this.notif.type = 'success';
                this.notif.message = message;
                setTimeout(() => {
                  this.notif.show = false;
                  this.notif.type = '';
                  this.notif.message = '';
                }, 3000)
              })
              .catch(({response}) => {
                this.hasErrorForm = true;
                this.errors.first_name = response?.data?.errors?.first_name;
                this.errors.last_name = response?.data?.errors?.last_name;
                this.errors.email = response?.data?.errors?.email;
                this.errors.phone = response?.data?.errors.phone;
                this.errors.birth_date = response?.data?.errors?.birth_date;
                this.errors.password = response?.data?.errors?.password;
              })
              .finally(() => {
                this.isLoadingSubmit = false;
                
              });
        
        
        return;
      },
      clearForm() {
        this.form.first_name = ''
        this.form.last_name = ''
        this.form.email = ''
        this.form.phone = ''
        this.form.birth_date = ''
        this.form.password = ''

        this.errors.first_name = ''
        this.errors.last_name = ''
        this.errors.email = ''
        this.errors.phone = ''
        this.errors.birth_date = ''
        this.errors.password = ''
      },
      changePassType() {
        if(this.passwordType === 'password') {
          this.passwordType = 'text';
        } else {
          this.passwordType = 'password'
        }
      }
    }
  }
</script>

<style scoped>
.isLoading {
    min-height: 50vh;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal-content{
  padding: 20px;
  background: #fff;
  border-radius: 10px;
}
</style>