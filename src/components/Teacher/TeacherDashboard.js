import React from 'react';
import { jsonServerRestClient, Admin, Resource } from 'admin-on-rest';

import { PostList } from './PostList';

const TeacherDashboard = () => {
  return (
    <Admin restClient={jsonServerRestClient('http://jsonplaceholder.typicode.com')}>
    <Resource name="posts" list={PostList} />
    </Admin>

  );
};

export default TeacherDashboard;
