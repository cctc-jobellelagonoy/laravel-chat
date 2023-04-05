<template>
  <div class="bottom_wrapper clearfix">
    <div class="message_input_wrapper">
      <input 
        class="message_input" 
        placeholder="Type your message here..." 
        type="text"
        name="message"
        v-model="newMessage"
        @keyup.enter="sendMessage"/>
    </div>
    <div class="send_message">
      <div class="icon"></div>
      <button 
      style="
        background-color: transparent;
        background-repeat: no-repeat;
        border: none;
        cursor: pointer;
        overflow: hidden;
        outline: none;"
      class="text" @click="sendMessage">Send</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],

  data() {
    return {
      newMessage: "",
    };
  },

  methods: {
    sendMessage() {
      console.log(this.newMessage.message);
      this.$emit("messagesent", {
        user: this.user,
        message: this.newMessage,
      });
     
      this.newMessage = "";
    }
  }
};
</script>
