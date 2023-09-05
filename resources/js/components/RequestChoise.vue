<script setup lang="ts">
import { ref, reactive, computed } from 'vue'
import { useTheme } from 'vuetify'
import TinyMCE from '@/components/TinyMCE.vue'
// data
defineProps({
  title: {
    type: String,
    default: '',
  },
  details: {
    type: Array,
    default: () => [],
  },
  modelValue: {
    type: Object,
    default: () => [],
  },
})

// data
const theme = useTheme()
// emit
defineEmits(['update:modelValue'])

const check = ref('')
let displayFlag = ref<boolean>(false)
const editorMyMemo = ref()
const editorPartnerMemo = ref()
let myMemoDispFlag = ref<boolean>(false)
let partnerMemoDispFlag = ref<boolean>(false)

const clickCheck = () => {
  displayFlag.value = !displayFlag.value
}

// エディタの保存時に呼ばれ、htmlを保存する
const handleUpdMyMemo = (obj: { html: string }): void => {
  // modelValue.from_memo = obj.html
  myMemoDispFlag.value = !myMemoDispFlag.value
}
const handleUpdpartnerMemo = (obj: { html: string }): void => {
  // modelValue.to_memo = obj.html
  partnerMemoDispFlag.value = !partnerMemoDispFlag.value
}

// エディタのsaveを呼び出し
const saveMyMemo = (): void => {
  editorMyMemo.value.save()
}
const savePartnerMemo = (): void => {
  editorPartnerMemo.value.save()
}

const dbClickMyMemo = (): void => {
  myMemoDispFlag.value = !myMemoDispFlag.value
}
const dbClickPartnerMemo = (): void => {
  partnerMemoDispFlag.value = !partnerMemoDispFlag.value
}
</script>

<template>
  <div class="request-form">
    <v-checkbox
      class="ml-16 pl-5 checkbox bg-backinput"
      v-model="check"
      hide-details
      density="compact"
      @click="clickCheck"
    >
      <template #label>
        <div
          class="pl-3 py-3 w-100 check-text"
          :class="
            theme.global.name.value == 'customDark'
              ? 'text-textlight'
              : 'text-first'
          "
        >
          {{ title }}
        </div>
      </template>
    </v-checkbox>
    <div v-if="displayFlag" class="choise-radio">
      <v-radio-group
        hide-details
        inline
        :value="modelValue.topic_detail_id"
        @update:modelValue="(v) => (modelValue.topic_detail_id = v)"
      >
        <v-radio
          style="width: 33%"
          class="text-textmain"
          v-for="detail in details"
          :label="detail.topic_detail_name"
          :value="detail.topic_detail_id"
        ></v-radio>
      </v-radio-group>
      <div class="d-flex mt-4">
        <div class="w-50">
          <v-alert
            class="mb-2 mr-2 bg-first text-textlight"
            text="自分用Memo"
            density="compact"
          ></v-alert>
          <div v-show="!myMemoDispFlag" class="mb-2 mr-2">
            <TinyMCE
              ref="editorMyMemo"
              :html="modelValue.from_memo"
              @update="handleUpdMyMemo"
              @update:modelValue="(v) => (modelValue.from_memo = v)"
              @blur="saveMyMemo"
            />
          </div>
          <div
            v-show="myMemoDispFlag"
            class="py-2 px-3 mr-2 memo"
            v-html="modelValue.from_memo"
            @dblclick="dbClickMyMemo"
          ></div>
        </div>
        <div class="w-50">
          <v-alert
            color="accent"
            class="mb-2 mr-2 bg-accent text-textlight"
            text="面談者Memo"
            density="compact"
          ></v-alert>
          <div v-show="!partnerMemoDispFlag" class="mb-2 mr-2">
            <TinyMCE
              ref="editorPartnerMemo"
              :html="modelValue.to_memo"
              @update="handleUpdpartnerMemo"
              @update:modelValue="(v) => (modelValue.to_memo = v)"
              @blur="savePartnerMemo"
            />
          </div>
          <div
            v-show="partnerMemoDispFlag"
            class="py-2 px-3 mr-2 memo-partner"
            v-html="modelValue.to_memo"
            @dblclick="dbClickPartnerMemo"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.check-text {
  font-weight: 600;
  letter-spacing: 0.125rem;
  font-size: 1.05rem;
}
.choise-radio {
  margin-top: 1%;
  margin-left: 4.2%;
  padding-left: 2%;
  border-left: solid 5px #2962ff;
  opacity: 1;
}

.request-form .checkbox {
  /* color: white;
  background: linear-gradient(
    90deg,
    rgba(41, 98, 255, 1) 24%,
    rgba(255, 255, 255, 1) 100%
  ); */
  border-radius: 30px;
}

.request-form label {
  opacity: 1;
}

.request-form .memo {
  color: #333;
  background: #e3f2fd;
  /* border-left: solid 5px #2962ff; */
  min-height: 200px;
  border-radius: 4px;
}

.request-form .memo-partner {
  color: #333;
  background: #fff3e0;
  /* border-left: solid 5px #ff6d00; */
  min-height: 200px;
  border-radius: 4px;
}
</style>
