import { UserInputError } from 'apollo-server'
import bycrypt from 'bcryptjs'
import jwt from 'jsonwebtoken'
import { AUTH_SECRET_KEY } from '../../config'
import User from '../../models/User'


const usersResolvers = {
    Mutation: {
        async register(parent: any, args: any, context: any, info: any) {
            let { username, password, confirmPassword, email } = args.registerInput

            const user = await User.findOne({username})
            if(user){
                throw new UserInputError("Username is taken", {
                    errors: {
                        username: "This username is taken"
                    }
                });
            }

            password = await bycrypt.hash(password, 12)

            const newUser = new User({
                email,
                username,
                password,
                createdAt: new Date().toISOString()
            })

            const result = await newUser.save()

            const token = jwt.sign({
                id: result.id,
                email: result.email,
                username: result.username
            }, AUTH_SECRET_KEY, {expiresIn: '1h'})

            return {
                id: result._id,
                token,
                email: result.email,
                username: result.username,
                createdAt: result.createdAt
            }
        }
    }
}

export default usersResolvers