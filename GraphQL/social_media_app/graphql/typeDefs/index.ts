import gql from 'graphql-tag'

const typeDefs = gql`
    type Post {
        id: ID!
        body: String!
        createdAt: String!
        username: String!
    } 
    type User {
        id: ID!
        email: String!
        token: String!
        username: String!
        createdAt: String!
    }
    input RegisterUser {
        username: String!
        password: String!
        confirmPassword: String!
        email: String!
    }
    type Query {
        sayHi: String!,
        getPosts: [Post]
    }
    type Mutation {
        register(registerInput: RegisterUser): User!
    }
`
export default typeDefs