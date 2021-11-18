pipeline {
 agent any
 stages {
 stage ('Checkout') {
 steps {
 git branch:'main', url: 'https://github.com/brandonneo/testing.git'
 }
 }

 stage('Code Quality Check via SonarQube') {
 steps {
 script {
 def scannerHome = tool 'SonarQube';
 withSonarQubeEnv('SonarQube') {
 sh "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=OWSAP -Dsonar.sources=. -Dsonar.host.url=http://localhost:9000 -Dsonar.login=cb38db110cd5441f33ddba33285e39e2ecbebbf9"
 }
 }
 }
 }
 }
 post {
 always {
 recordIssues enabledForFailure: true, tool: sonarQube()
 }
 }
}
