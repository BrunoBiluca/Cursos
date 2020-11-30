import { ApolloServer } from 'apollo-server'
import gql from 'graphql-tag'
import mongoose from 'mongoose'
import { MONGODB } from './config'
import Post from './models/Post'

const typeDefs = gql`
    type Post {
        id: ID!
        body: String!
        createdAt: String!
        username: String!
    }
    type Query {
        sayHi: String!,
        getPosts: [Post]
    }
`

const resolvers = {
    Query: {
        sayHi: () => 'Hello World!',
        async getPosts(){
            try {
                return await Post.find()
            } catch (err){
                throw new Error(err)
            }
        }
    }
}

const server = new ApolloServer({
    typeDefs,
    resolvers
})

mongoose.connect(MONGODB, {useNewUrlParser: true})
.then(() => {
    console.log("MongoDB connected")
    return server.listen({ port: 8080 })
})
.then((res) => {
    console.log(`Server running at ${res.url}`)
})