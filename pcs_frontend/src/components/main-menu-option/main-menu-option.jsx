import './main-menu-option.css'

const MainMenuOptions = ({
  label,
  onClick
}) => {
  return(
    <div className='main-menu-option' onClick={ () => onClick() }>
      <span className='label'>{ label }</span>
    </div>
  )
}

export default MainMenuOptions