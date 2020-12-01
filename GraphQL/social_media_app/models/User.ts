import { Document, model, Schema } from 'mongoose'


const userSchema = new Schema({
    username: String,
    password: String,
    email: String,
    createdAt: String
})

interface UserModel extends Document {
    username: String,
    password: String,
    email: String,
    createdAt: String
}

export default model<UserModel>('User', userSchema)