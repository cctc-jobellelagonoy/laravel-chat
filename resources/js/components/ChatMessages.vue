
<template>
   <ul class="messages">
     <div class="message_template" v-for="message in messages" :key="message.id">
        <li class="message right appeared">
           <div class="avatar"></div>
           <div class="text_wrapper">
              <div class="text">{{ message.message }}</div>
           </div>
        </li>
        <li class="message left appeared" v-if="message.ai_reply">
           <div class="avatar"></div>
           <div class="text_wrapper">
              <div class="text">{{ message.ai_reply }}</div>
           </div>
        </li>
     </div>
   </ul>
</template>

<script>
export default {
  props: ["messages"],
};
</script>
