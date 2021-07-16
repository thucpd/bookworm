
import Home from '../components/Home';
import Shop from '../components/Shop';
import About from '../components/About';


const routes = [
    {
        path: '/',
        component: Home,
        name: 'index',
    },
    {
        path: '/shop',
        component: Shop,
        name: 'shop',
    },
    {
        path: '/about',
        component: About,
        name: 'about',
    }
];

export default routes;