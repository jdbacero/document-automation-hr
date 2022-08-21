<script>
import axios from 'axios'
import { reactive } from 'vue'

export const store = reactive({
  documents: [],
  getDocuments() {
        axios.post('/api/document/categories')
        .then(response => {
            this.documents = response.data
            console.log(response.data)
        })
  },
  isDark: false
})
</script>