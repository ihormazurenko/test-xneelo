
export const Drawer = ({children, isOpen, onClose}) => {
    const classes = `drawer ${isOpen ? 'is-open': ''}`;

    return (
        <div className={classes}>
            <button className="btn-close" onClick={onClose}>&times;</button>
            {children}
        </div>
    );
};