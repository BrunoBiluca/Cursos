import postsResolvers from "./posts";
import usersResolvers from "./users";

const resolvers = {
    Query: {
        sayHi: () => 'Hello World!',
        ...postsResolvers.Query
    },
    Mutation: {
        ...usersResolvers.Mutation
    }
}
export default resolvers