import axios from 'axios';

const apiStatus = axios.create({ baseURL: 'http://127.0.0.1:8080/api'});

export default apiStatus;