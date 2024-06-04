import { Navigate } from 'react-router';
import { useAuth } from '../../providers/auth-provider';

const ProtectedRoute = ({ children }) => {
  const { user } = useAuth();
  if (!user) {
    return <Navigate to='/' />;
  }

  return children;
}

export default ProtectedRoute;