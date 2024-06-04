import { Formik } from 'formik'
import './register.css'
import { useAuth } from '../providers/auth-provider'
import { Link, useNavigate } from 'react-router-dom'
import UserApi from '../api/user-api'

const Register = () => {

  const navigate = useNavigate()

  const handleSubmit = async (values) => {
    await UserApi.register(
      values.email,
      values.name,
      values.password,
      values.password_confirmation
    ).then((response) => {
      alert('pembuatan akun berhasil!')
      navigate('/')
    })
  }

  return(
    <Formik
      initialValues={{
        email: '',
        name: '',
        password: '',
        password_confirmation: ''
      }}
      onSubmit={ handleSubmit }
    >
      {({
        values,
        errors,
        touched,
        handleChange,
        handleBlur,
        handleSubmit
      }) => (
        <div className='login'>
          <div className='form'>
            <form noValidate onSubmit={ handleSubmit }>
              <span>{ 'Login' }</span>

              <input
                type='email'
                name='email'
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.email}
                placeholder='Enter email'
                className='form-control inp_text'
                id='email'
              />

              <input
                type='text'
                name='name'
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.name}
                placeholder='Enter name'
                className='form-control inp_text'
                id='email'
              />

              <input
                type='password'
                name='password'
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.password}
                placeholder='Enter password'
                className='form-control'
              />

              <input
                type='password'
                name='password_confirmation'
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.password_confirmation}
                placeholder='Reenter password'
                className='form-control'
              />

              <button type='submit'>{ 'Register' }</button>
            </form>
          </div>
        </div>
      )}
    </Formik>
  )
}

export default Register