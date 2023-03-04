export default {
    methods: {
    changeComponent(component,componentId=0,formType='') {
    this.$emit('change-component',{component,componentId,formType});
    },
    }
   }
   