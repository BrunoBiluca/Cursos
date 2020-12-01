import Post from "../../models/Post"

const postsResolvers = {
    Query: {
        async getPosts(){
            try {
                return await Post.find()
            } catch (err){
                throw new Error(err)
            }
        }
    }
}
export default postsResolvers