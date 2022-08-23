<script>
import axios from 'axios'
import { reactive } from 'vue'

export const store = reactive({
  documents: [],
  getDocuments(is_admin = 0) {
        axios.post('/api/document/categories',
        {
          'is_admin' : is_admin
        })
        .then(response => {
            this.documents = response.data
            console.log(response.data)
        })
  },
  isDark: false,
})
</script>