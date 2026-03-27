
import { auth } from "../firebase";
import { signInWithEmailAndPassword } from "firebase/auth";

export const login = (email, pass) =>
  signInWithEmailAndPassword(auth, email, pass);
