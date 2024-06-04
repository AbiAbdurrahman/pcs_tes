import { Formik } from 'formik'
import './login.css'
import AuthApi from '../api/auth-api'
import { useAuth } from '../providers/auth-provider'
import { Link, useNavigate } from 'react-router-dom'

const Login = () => {

  const authContext = useAuth()
  const navigate = useNavigate()

  const handleSubmit = async (values) => {
    await AuthApi.login(
      values.email,
      values.password
    ).then((response) => {
      const data = response.data
      authContext.login({
        name: data.username,
        token: data.access_token,
        token_type: data.token_type
      })
    })
  }

  return(
    <Formik
      initialValues={{ email: '', password: '' }}
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
                type='password'
                name='password'
                onChange={handleChange}
                onBlur={handleBlur}
                value={values.password}
                placeholder='Enter password'
                className='form-control'
              />
              <div style={{ marginTop: '10px', marginBottom: '10px' }}>
                <Link onClick={ () => navigate('/register') }>{'register'}</Link>
              </div>

              <button type='submit'>{ 'Login' }</button>
            </form>
          </div>
        </div>
      )}
    </Formik>
  )
}

export default Login