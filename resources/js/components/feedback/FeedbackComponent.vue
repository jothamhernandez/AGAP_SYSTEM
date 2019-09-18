<template>
  <div class="feedback-component">
    <div class="feedback-button" @click="toggleForm"><span class="fa fa-comment"></span> Feedback</div>
    <div class="feedback-overlay" v-if="isShown" @click="toggleForm">
      <div class="card card-default feedback-panel" @click="preventDefault">
        <div class="card-header agap-primary-color">Feedback Form</div>
        <div class="card-body">
          <div class="form-group">
            <input
              v-model="form.email"
              type="email"
              class="form-control"
              placeholder="email address"
            />
          </div>
          <div class="form-group">
            <textarea
              v-model="form.message"
              style="resize: none;"
              name
              id
              cols="30"
              rows="10"
              class="form-control"
              placeholder="please enter something descriptive or describe in details regarding the feedback. (ex.) I don't received the email from the system to verify my account."
            ></textarea>
          </div>
          <div class="form-group">
            <span class="small">
              Please enter information with honesty as we will try to communicate with you and fixed your problem. you might want to leave your inquiry to
              <a
                href="https://www.facebook.com/pinwheel.it/"
                target="__blank"
              >the developer</a>
            </span>
          </div>
          <div class="form-group">
            <button class="btn btn-block btn-success" @click="submitFeedback">Submit Feedback</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isShown: false,
      form: {
        email: "",
        message: ""
      }
    };
  },
  methods: {
    toggleForm() {
      this.isShown = !this.isShown;
      this.form.email = "";
      this.form.message = "";
    },
    preventDefault(e) {
      e.stopPropagation();
    },
    submitFeedback() {
      if (
        this.form.email.trim().length <= 0 ||
        this.form.message.trim().length <= 0 ||
        !this.validateEmail(this.form.email)
      ) {
        alert("please fill with all honesty");
      } else {
        axios
          .post("/api/v1/feedback", this.form)
          .then(resp => {

            if(resp.status === 200){
                this.form.email = "";
                this.form.message = "";
                alert('feedback submitted successfully');
                this.toggleForm();
            }
            
          });
      }
    },
    validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }
  }
};
</script>

<style scoped>
.feedback-overlay {
  background-color: rgba(0, 0, 0, 0.5);
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0px;
  left: 0px;
  z-index: 10000;
  display: flex;
  justify-content: center;
  align-items: center;
}

.feedback-panel {
  width: 500px;
  min-height: 300px;
}

.feedback-button {
  background-color: #0004e3;
  display: inline-block;
  position: fixed;
  bottom: 0px;
  left: 30px;
  padding: 9px 10px 5px;
  color: white;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  cursor: pointer;
}
.feedback-button:hover {
  background-color: #4242f7;
  padding-bottom: 10px;
}
</style>