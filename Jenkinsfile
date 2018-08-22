pipeline {

    options {
        // Build auto timeout
        timeout(time: 60, unit: 'MINUTES')
    }

    agent none

    stages {
        stage('build') {
            agent { docker 'composer' }
            steps {
                sh "composer install"
            }
        }
//        stage('Create Docker images') {
//            agent { docker 'docker' }
//                sh 'docker build -t ${env.DOCKER_REGISTRY}/cnb/back:${env.GIT_COMMIT} .'
//                sh 'docker tag ${env.DOCKER_REGISTRY}/cnb/back:${env.GIT_COMMIT} ${DOCKER_REGISTRY}/cnb/back:${env.BRANCH_NAME} ' 
//                sh 'docker push ${env.DOCKER_REGISTRY}/cnb/back:${env.GIT_COMMIT} '
//                sh 'docker push ${env.DOCKER_REGISTRY}/cnb/back:${env.BRANCH_NAME} '
//        }
    }
}