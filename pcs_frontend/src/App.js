import { Routes, Route } from 'react-router-dom'
import './App.css';
import Login from './pages/login'
import HomePage from './pages/home-page'
import ProtectedRoute from './components/protected-route'


function App() {
  return (
    <div className="App">
      <Routes>
        <Route path='/' element={<Login />} />
        {/* <Route path='/register' element={<Register />} /> */}
        <Route path='/home' element={
          <ProtectedRoute>
            <HomePage />
          </ProtectedRoute>
        } />
      </Routes>

    </div>
  );
}

export default App;
