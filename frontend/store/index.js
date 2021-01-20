export const actions = {
    async getAllImages({ state, commit }) {
        let res = await this.$axios.$get('/view-all-images');
        //commit if needed
        return res
    },

}